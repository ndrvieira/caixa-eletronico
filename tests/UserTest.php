<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $connectionsToTransact = ['mysql'];
    protected $api_prefix = '/api/v1/users';
    protected $api_prefix_with_user_code = '';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->api_prefix_with_user_code = $this->api_prefix . '/' . $this->user->id;
    }
    
    /**
     * @test
     */
    public function listar_usuarios()
    {
        $this->get($this->api_prefix)->seeStatusCode(200);
    }

    /**
     * @test
     */
    public function cadastrar_usuario()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => 'André',
            'cpf' => '959.357.500-66',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(201)->seeJsonStructure([
            'id',
            'message',
        ]);

        $this->seeInDatabase('users', ['cpf' => '959.357.500-66']);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_sem_informar_cpf()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => 'André',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_sem_informar_nome()
    {
        $this->json('POST', $this->api_prefix, [
            'cpf' => '959.357.500-66',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_sem_informar_data_de_nascimento()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => 'André',
            'cpf' => '959.357.500-66'
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_com_cpf_invalido()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => 'André',
            'cpf' => '111.111.111-11',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_com_data_de_nascimento_invalida()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => 'André',
            'cpf' => '959.357.500-66',
            'data_nascimento' => '01/01/20',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function cadastrar_usuario_sem_nome()
    {
        $this->json('POST', $this->api_prefix, [
            'nome' => '',
            'cpf' => '959.357.500-66',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function exibe_usuario()
    {
        $this->get($this->api_prefix_with_user_code)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'id',
                'nome',
                'cpf',
                'data_nascimento'
            ]);
    }

    /**
     * @test
     */
    public function exibe_usuario_inexistente()
    {
        $last_user = DB::table('users')->latest()->first();
        $last_plus_one = $last_user->id + 1;
        $this->get($this->api_prefix . '/' . $last_plus_one)
            ->seeStatusCode(404)
            ->seeJsonStructure([
                'error' => [
                    'code',
                    'message'
                ]
            ]);
    }

    /**
     * @test
     */
    public function editar_usuario()
    {
        $this->json('PATCH', $this->api_prefix_with_user_code, [
            'nome' => 'André',
            'data_nascimento' => '01/01/2001',
        ])->seeStatusCode(200)->seeJsonContains([
            'user' => [
                'id' => $this->user->id,
                'cpf' => $this->user->cpf,
                'nome' => 'André',
                'data_nascimento' => '01/01/2001'
            ]
        ]);
    }

    /**
     * @test
     */
    public function editar_usuario_com_nome_muito_grande()
    {
        $this->json('PATCH', $this->api_prefix_with_user_code, [
            'nome' => 'umtextomuitograndedemaisoumenosunscemcaracteresprecisasermaiordoqueissotaquasemaisumpoucochegolaedeuu',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function editar_usuario_com_data_de_nascimento_fora_do_padrao()
    {
        $this->json('PATCH', $this->api_prefix_with_user_code, [
            'data_nascimento' => '01-01-2001',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function deletar_cliente()
    {
        $this->json('DELETE', $this->api_prefix_with_user_code)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'message'
            ]);

        $this->notSeeInDatabase('users', ['cpf' => $this->user->cpf]);
    }
}

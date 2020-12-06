<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use App\Models\Account;
use App\Models\AccountType;
use App\Http\Services\ATM;
use App\Models\TransactionType;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;

class AccountTest extends TestCase
{
    use DatabaseTransactions;

    protected $connectionsToTransact = ['mysql'];
    protected string $api_prefix = '/api/v1/users';
    protected string $api_prefix_with_user_id = '';
    protected int $id_tipo_poupanca = 0;
    protected int $id_tipo_corrente = 0;
    protected User $user;

    public function setUp(): void {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->api_prefix_with_user_id = $this->api_prefix . '/' . $this->user->id;
        $this->id_tipo_poupanca = AccountType::where('name', 'poupança')->first()->id;
        $this->id_tipo_corrente = AccountType::where('name', 'corrente')->first()->id;
    }
    
    /**
     * @setUp
     * @test
     */
    public function listar_contas()
    {
        $this->get($this->api_prefix_with_user_id . '/accounts')
            ->seeStatusCode(200)
            ->seeJson([]);
        
        $account = factory(Account::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->get($this->api_prefix_with_user_id . '/accounts')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'id' => $account->id,
                'user_id' => $this->user->id,
                'account_type_id' => $account->account_type_id,
                'saldo' => $account->amount,
                'tipo' => $account->accountType->name
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function listar_contas_em_um_usuario_inexistente()
    {
        $last_user = DB::table('users')->latest()->first();
        $last_plus_one = $last_user->id + 1;
        $this->get($this->api_prefix . '/' . $last_plus_one . '/accounts')
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
    public function cadastrar_conta_poupanca()
    {
        /** Tenta criar conta poupança */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'poupança',
            'saldo' => 0,
        ])->seeStatusCode(201)->seeJsonStructure([
            'id',
            'message',
        ])->seeInDatabase('accounts', [
            'user_id' => $this->user->id,
            'account_type_id' => $this->id_tipo_poupanca,
            'amount' => 0
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function cadastrar_conta_corrente()
    {
        /** Tenta criar conta corrente */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'corrente',
            'saldo' => 50,
        ])->seeStatusCode(201)->seeJsonStructure([
            'id',
            'message',
        ])->seeInDatabase('accounts', [
            'user_id' => $this->user->id,
            'account_type_id' => $this->id_tipo_corrente,
            'amount' => 50
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function cadastrar_uma_conta_de_um_tipo_ja_existente()
    {
        /** Tenta criar conta poupança */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'poupança',
            'saldo' => 0,
        ])->seeStatusCode(201)->seeJsonStructure([
            'id',
            'message',
        ])->seeInDatabase('accounts', [
            'user_id' => $this->user->id,
            'account_type_id' => $this->id_tipo_poupanca,
            'amount' => 0
        ]);
        
        /** Tenta criar conta poupança de novo */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'poupança',
            'saldo' => 0,
        ])->seeStatusCode(409)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function cadastrar_conta_sem_tipo()
    {
        /** Tipo omitido */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'saldo' => 50,
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
    public function cadastrar_conta_com_saldo_string()
    {
        /** Saldo não numérico */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'corrente',
            'saldo' => 'abc',
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
    public function cadastrar_conta_com_saldo_negativo()
    {
        /** Saldo não numérico */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'corrente',
            'saldo' => -1,
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
    public function cadastrar_conta_com_tipo_invalido_string()
    {
        /** Tipo inválido */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 'teste',
            'saldo' => 50,
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
    public function cadastrar_conta_com_tipo_invalido_integer()
    {
        /** Tipo inválido */
        $this->json('POST', $this->api_prefix_with_user_id . '/accounts', [
            'tipo' => 50,
            'saldo' => 50,
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
    public function depositar()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/deposit', [
            'valor' => 50,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 1050
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function depositar_valor_invalido_negativo()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/deposit', [
            'valor' => -1,
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function depositar_valor_invalido_string()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/deposit', [
            'valor' => 'abc',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_via_api_50()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 50,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 950,
            'notas' => [
                '100' => 0,
                '50' => 1,
                '20' => 0
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_via_api_110()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 110,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 890,
            'notas' => [
                '100' => 0,
                '50' => 1,
                '20' => 3
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_via_api_230()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 230,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 770,
            'notas' => [
                '100' => 1,
                '50' => 1,
                '20' => 4
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_via_api_240()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 240,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 760,
            'notas' => [
                '100' => 2,
                '50' => 0,
                '20' => 2
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_via_api_270()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 270,
        ])->seeStatusCode(200)->seeJsonContains([
            'saldo' => 730,
            'notas' => [
                '100' => 2,
                '50' => 1,
                '20' => 1
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

        /**
     * @test
     */
    public function sacar_mais_do_que_possui_em_conta()
    {
        $account = factory(Account::class)->create([
            'amount' => 500,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 550,
        ])->seeStatusCode(400)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_valor_negativo()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => 'abc',
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_valor_string()
    {
        $account = factory(Account::class)->create([
            'amount' => 1000,
        ]);

        $this->post($this->api_prefix_with_user_id . '/accounts/' . $account->id . '/withdraw', [
            'valor' => -1,
        ])->seeStatusCode(422)->seeJsonStructure([
            'error' => [
                'code',
                'message'
            ]
        ]);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_5()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $this->expectException(HttpException::class);
        $this->expectExceptionCode(400);
        (new ATM($account, $transaction_type, 5))->initiateOperation();

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_10()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $this->expectException(HttpException::class);
        $this->expectExceptionCode(400);
        (new ATM($account, $transaction_type, 10))->initiateOperation();

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_20()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 20);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 0,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 20, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_30()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $this->expectException(HttpException::class);
        $this->expectExceptionCode(400);
        (new ATM($account, $transaction_type, 30))->initiateOperation();

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_40()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 40);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 0,
            20 => 2,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 40, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_50()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);

        $atm = new ATM($account, $transaction_type, 50);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 1,
            20 => 0,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 50, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_60()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 60);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 0,
            20 => 3,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 60, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_70()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 70);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 1,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 70, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_75()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $this->expectException(HttpException::class);
        $this->expectExceptionCode(400);
        (new ATM($account, $transaction_type, 75))->initiateOperation();

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_80()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 80);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 0,
            20 => 4,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 80, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_90()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 90);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 1,
            20 => 2,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 90, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_100()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 100);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 1,
            50 => 0,
            20 => 0,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 100, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_120()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 120);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 1,
            50 => 0,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 120, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_130()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 130);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 0,
            50 => 1,
            20 => 4,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 130, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_160()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 160);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 1,
            50 => 0,
            20 => 3,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 160, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_170()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 170);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 1,
            50 => 1,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 170, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_310()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 310);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 2,
            50 => 1,
            20 => 3,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 310, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_320()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 320);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 0,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 320, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }


    /**
     * @test
     */
    public function sacar_330()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 330);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 2,
            50 => 1,
            20 => 4,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 330, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_340()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 340);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 0,
            20 => 2,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 340, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_350()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 350);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 1,
            20 => 0,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 350, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_360()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 360);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 0,
            20 => 3,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 360, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_370()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 370);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 1,
            20 => 1,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 370, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_380()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 380);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 0,
            20 => 4,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 380, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_390()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 390);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 3,
            50 => 1,
            20 => 2,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 390, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_400()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 400);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 4,
            50 => 0,
            20 => 0,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 400, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }

    /**
     * @test
     */
    public function sacar_1250()
    {
        $transaction_type = TransactionType::where('name', 'withdraw')->first();
        $account = factory(Account::class)->create([
            'amount' => 10000,
        ]);
        
        $atm = new ATM($account, $transaction_type, 1250);
        $atmResponse = $atm->initiateOperation();
        $this->assertEquals([
            100 => 12,
            50 => 1,
            20 => 0,
        ], $atmResponse->returning_bills);
        $this->assertEquals(10000 - 1250, $atmResponse->account->amount);

        Account::where('user_id', $this->user->id)->delete();
    }
}

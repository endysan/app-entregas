<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CLIENTE 1 = CLIENTE
        DB::table('cliente')->insert([
            'nome' => 'Cliente',
            'email' => 'cliente@email.com',
            'password' => bcrypt('123'),
        ]);
        

        // CLIENTE 2 = ENTREGADOR
        DB::table('cliente')->insert([
            'nome' => 'Entregador',
            'email' => 'entregador@email.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('entregador')->insert([
            'cliente_id' => 2,
        ]);
        DB::table('cliente')->where('id', 2)->update([
            'entregador_id' => 1
        ]);
    }
}

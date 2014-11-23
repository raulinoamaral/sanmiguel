<?php 
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user')->delete();

        User::create(array(
        	'username' => 'Marcelo',
            'password' => Hash::make('felipe2012')
        	));
        
    }

}
?>
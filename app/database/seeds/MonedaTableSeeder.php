<?php 
class MonedaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('moneda')->delete();

        Moneda::create(array(
        	'name' => 'U$S'
        	));
        Moneda::create(array(
        	'name' => '$'
        	));
        
    }

}
?>
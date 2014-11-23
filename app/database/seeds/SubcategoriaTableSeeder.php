<?php 
class SubcategoriaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('subcategoria')->delete();

        Subcategoria::create(array(
        	'name' => 'Porteras',
        	'categoria_id' => 1,
            'description'  =>   'Sin description'
        	));

       	Subcategoria::create(array(
        	'name' => 'Embarcaderos',
        	'categoria_id' => 1,
            'description'  =>   'Sin description'
        	));
    }

}
?>
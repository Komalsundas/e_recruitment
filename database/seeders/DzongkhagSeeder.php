<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dzongkhag;
use Illuminate\Support\Facades\DB;

class DzongkhagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dzongkhag::create([

            'dzongkhag_name' => 'Thimphu'


        ]);

        Dzongkhag::create([
            'dzongkhag_name' => 'Paro'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Haa'

        ]);

        Dzongkhag::create([
            'dzongkhag_name' => 'Wangdue Phodrang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Punakha'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Gasa'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Chukha'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Samtse'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Bumthang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Tsirang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Sarpang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Dagana'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Samdrup Jongkhar'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Zhamgang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Trongsa'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Mongar'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Trashigang'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Lhuntse'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Trashi Yangtse'
        ]);
        Dzongkhag::create([
            'dzongkhag_name' => 'Pema Gyaltsel'
        ]);


    }
}
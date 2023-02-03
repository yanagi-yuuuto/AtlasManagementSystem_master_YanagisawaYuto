<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name' => '高橋',
                'under_name' => '巧',
                'over_name_kana' => 'タカハシ',
                'under_name_kana' => 'タクミ',
                'mail_address' => 'takahasi.takumi@gmail.com',
                'sex' => '1',
                'birth_day' => '2000-01-01',
                'role' => '1',
                'password' => bcrypt('takahashitakumi')
            ],
            [
                'over_name' => '乾',
                'under_name' => '雄介',
                'over_name_kana' => 'イヌイ',
                'under_name_kana' => 'ユウスケ',
                'mail_address' => 'inui.yusuke@gmail.com',
                'sex' => '1',
                'birth_day' => '2000-02-02',
                'role' => '2',
                'password' => bcrypt('inuiyusuke')
            ],
            [
                'over_name' => '渡辺',
                'under_name' => '秀介',
                'over_name_kana' => 'ワタナベ',
                'under_name_kana' => 'シュウスケ',
                'mail_address' => 'watanabe.shusuke@gmail.com',
                'sex' => '1',
                'birth_day' => '2000-03-03',
                'role' => '3',
                'password' => bcrypt('watanabeshusuke')
            ],
            [
                'over_name' => '泉',
                'under_name' => '加奈',
                'over_name_kana' => 'イズミ',
                'under_name_kana' => 'カナ',
                'mail_address' => 'izumi.kana@gmail.com',
                'sex' => '2',
                'birth_day' => '2000-04-04',
                'role' => '4',
                'password' => bcrypt('izumikana')
            ]
          ]);
    }
}

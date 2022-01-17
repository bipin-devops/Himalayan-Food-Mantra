<?php

use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $templates = [
            [
                'title' => 'Forgot Password',
                'code' => 'ForgotPassword',
                'from' => 'himalayafoodmantra@gmail.com',
                'subject' => 'Forgot Password',
                'template' =>
                    '<p>Hello,</p>
                      <p>Please Click the Button to Reset The Password.</p>
                       <button><a href="%link%">Reset The Password </a></button>
                       <p>If you did not create a account,no further action is required.</p>   '


            ]
        ];

        foreach ($templates as $template) {
            $testTemplate = \App\EmailTemplate::where('code', $template['code'])->first();
            if (!$testTemplate) {
                $data = [
                    'title' => $template['title'],
                    'code' => $template['code'],
                    'from' => $template['from'],
                    'subject' => $template['subject'],
                    'template' => $template['template'],

                ];
                \App\EmailTemplate::create($data);

            }
        }
    }

}

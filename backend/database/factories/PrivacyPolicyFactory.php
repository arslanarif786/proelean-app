<?php

namespace Database\Factories;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivacyPolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrivacyPolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description'=> 'These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Webiste Name accessible at Website.com. These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions. Minors or people below 18 years old are not allowed to use this Website.
            Other than the content you own, under these Terms, Company Name and/or its licensors own all the intellectual property rights and materials contained in this Website.You are granted limited license only for purposes of viewing the material contained on this Website.
            You are specifically restricted from all of the following:
                publishing any Website material in any other media;
                selling, sublicensing and/or otherwise commercializing any Website material;
                publicly performing and/or showing any Website material;
                using this Website in any way that is or may be damaging to this Website;
                using this Website in any way that impacts user access to this Website;
                using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;
                engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;
                using this Website to engage in any advertising or marketing.
                Certain areas of this Website are restricted from being access by you and Company Name may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.
            In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant Company Name a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.Your Content must be your own and must not be invading any third-partys rights. Company Name reserves the right to remove any of Your Content from this Website at any time without notice.
            In no event shall Company Name, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract.  Company Name, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.'

        ];
    }
}

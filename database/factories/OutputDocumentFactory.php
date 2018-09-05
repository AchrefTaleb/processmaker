<?php

use Ramsey\Uuid\Uuid;
use Faker\Generator as Faker;
use ProcessMaker\Model\OutputDocument;
use ProcessMaker\Model\Process;

/**
 * Model factory for a Output Document.
 */
$factory->define(OutputDocument::class, function (Faker $faker) {
    return [
        'uid' => Uuid::uuid4(),
        'process_id' => function () {
            return factory(Process::class)->create()->id;
        },
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(5),
        'filename' => $faker->sentence(5),
        'report_generator' => $faker->randomElement(OutputDocument::DOC_REPORT_GENERATOR_TYPE),
        'generate' => $faker->randomElement(OutputDocument::DOC_GENERATE_TYPE),
        'type' => $faker->randomElement(OutputDocument::DOC_TYPE),
        'current_revision' => $faker->randomElement([0,1]),
        'open_type' => $faker->randomElement([0,1]),
        'template' => $faker->randomHtml(2,3),
        'versioning' => $faker->randomElement([0,1]),
        'properties' => [
            'pdf_security_permissions' => $faker->randomElements(OutputDocument::PDF_SECURITY_PERMISSIONS_TYPE, 2, false),
            'pdf_security_open_password' => 'test open password',
            'pdf_security_owner_password' => 'test owner password',
            'landscape' => false,
            'media' => 'pdf',
            'left_margin' => 0,
            'right_margin' => 0,
            'top_margin' => 0,
            'bottom_margin' => 0,
            'pdf_security_enabled' => false,
        ]
    ];
});

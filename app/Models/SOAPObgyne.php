<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SOAPObgyne extends Model
{
    protected $fillable = [
        "soap_id",
        "lmp",
        "edc",
        "edc_source",
        "aog",
        "fh",
        "fht",
        "ie",
        "gravida",
        "para",
        "term",
        "preterm",
        "abortion",
        "living",
        "presentation",
        "remarks"
    ];

    protected $casts = [
        'created_at' => "datetime",
        'updated_at' => "datetime",
        "lmp" => "date",
        "edc" => "date"
    ];
}

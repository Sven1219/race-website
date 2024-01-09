<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapedLink extends Model
{
    protected $table = 'scraped_links';
    use HasFactory;
}

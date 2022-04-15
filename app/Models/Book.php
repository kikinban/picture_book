<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Home extends Model
class Book
{
    // use HasFactory;
    public string $title;
    public string $writer;
    public int $target_age;
    public string $image_url;

    public function __construct(
        string $title,
        string $writer,
        int $target_age,
        string $image_url
    ){
        $this->title = $title;
        $this->writer = $writer;
        $this->target_age = $target_age;
        $this->image_url = $image_url;
    }

}

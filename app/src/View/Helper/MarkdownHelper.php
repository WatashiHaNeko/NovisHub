<?php
declare(strict_types=1);

namespace App\View\Helper;

use App\Utility\Markdown;
use Cake\View\Helper;

class MarkdownHelper extends Helper {
  public function parse(?string $text): string {
    return Markdown::parse($text);
  }
}


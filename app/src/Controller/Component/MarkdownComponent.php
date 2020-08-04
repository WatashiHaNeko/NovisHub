<?php
declare(strict_types=1);

namespace App\Controller\Component;

use App\Utility\Markdown;
use Cake\Controller\Component;

class MarkdownComponent extends Component {
  public function parse(?string $text): string {
    return Markdown::parse($text);
  }
}


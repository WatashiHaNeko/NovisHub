<?php
declare(strict_types=1);

namespace App\Utility;

use cebe\markdown\GithubMarkdown;

class Markdown {
  public static function parse(?string $text): string {
    if (empty($text)) {
      return '';
    }

    $parser = new GithubMarkdown();

    return $parser->parse($text);
  }
}


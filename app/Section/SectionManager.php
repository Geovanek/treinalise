<?php
declare(strict_types=1);

namespace App\Section;

class SectionManager
{
    private $section = 'app';

    /**
     * @return string
     */
    public function getsection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     */
    public function setsection(string $section): void
    {
        $this->section = $section;
    }

    public function get(string $key = null)
    {
        return $key ? config("sections.sections.{$this->section}.{$key}") :
            config("sections.sections.{$this->section}");
    }
}
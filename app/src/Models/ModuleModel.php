<?php

namespace App\Facilitate\Models;

use App\Facilitate\Repositories\ModuleRepository;

class ModuleModel extends Model
{
    const TABLE = 'modules';

    private string $name;
    private string $subgroup;
    private string $link;

    public static function getInstance(): Model
    {
        parent::getInstance()->setTable(self::TABLE);
        parent::$model = self::class;
        return parent::getInstance();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubgroup()
    {
        return $this->subgroup;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSubgroup($subgroup)
    {
        $this->subgroup = $subgroup;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
}

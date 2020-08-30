<?php


namespace Task\SimpleClasses;


class Getter
{
    /**
     * @param string $file_name
     * @return array
     */
    public function getAll(string $file_name) : array {
        return unserialize(trim(file_get_contents($file_name))) == false
                ? []
                : unserialize(trim(file_get_contents($file_name)));
    }

    /**
     * @param string $file_name
     * @param int $id
     * @return array
     */
    public function getById(string $file_name, int $id) : array {
        $items = $this->getAll($file_name);

        foreach ($items as $index => $item) {
            if ( $index == $id)
                return $item;
        }
        return [];
    }
}

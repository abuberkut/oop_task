<?php


namespace Task\SimpleClasses;


class Crud
{
    /**
     * @param string $file_name
     * @param array $item
     * @return string
     */
    public function create(string $file_name, array $item) {
        $items = (new Getter)->getAll($file_name);

        $items[] = $item;

        file_put_contents($file_name, serialize($items));

        return 'New item successfully created in '.$file_name.' file.';
    }

    /**
     * @param string $file_name
     * @param int $id
     * @param array $item
     * @return string
     */
    public function update(string $file_name, int $id, array $item) {

        $items = (new Getter)->getAll($file_name);

        if ( !array_key_exists($id, $items) ) {
            return 'The given id = '.$id.' doesn`t exist in '.$file_name.' file.';
        }

        $items[$id] = $item;

        file_put_contents($file_name, serialize($items));

        return 'Item with given id = '.$id.' successfully updated in '.$file_name.' file.';
    }

    /**
     * @param int $id
     * @param string $file_name
     * @return string
     */
    public function delete(int $id, string $file_name){
        $items = (new Getter)->getAll($file_name);

        if ( !array_key_exists($id, $items) ) {
            return 'The given id = '.$id.' doesn`t exist in '.$file_name.' file.';
        }

        unset($items[$id]);

        file_put_contents($file_name, serialize($items));

        return 'Item with given id = '.$id.' successfully deleted from '.$file_name.' file.';
    }

}

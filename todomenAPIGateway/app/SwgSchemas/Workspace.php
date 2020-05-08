<?php


namespace App\SwgSchemas;


/**
 * @OA\Schema(
 *   schema="NewWorkspace",
 *   required={"name"}
 * )
 */
class Workspace
{
    public $id;
    /**
     * @OA\Property(type="string")
     */
    public $name;

    public $tag;
}

/**
 *  @OA\Schema(
 *   schema="Workspace",
 *   type="object",
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/NewWorkspace"),
 *       @OA\Schema(
 *           required={"id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

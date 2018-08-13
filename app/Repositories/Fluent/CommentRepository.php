<?php
namespace App\Repositories\Fluent;

use App\Repositories\CommentRepositoryInterface;
use App\Model\Cocktail;

class CommentRepository extends AbstractFluent implements CommentRepositoryInterface
{
    protected $table = 'comments';

    /**
     * Get a table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * Create a new comment.
     *
     * @param $comment object item_id, user_id, body, username, email
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createComment($comment)
    {
        return Cocktail::with([
            'ingredients',
            'tags',
            'tags.category'
        ])
        ->get();
    }

    /**
     * Update a comment's body.
     *
     * @param $id int
     * @param $body string
     * @return Illuminate\Database\Eloquent\Model
     */
    public function updateComment($id, $body)
    {
        $object = array();
        $object["body"] = $body;
        $wkey["id"] = $id;
        $ret = $this->update($object, $wkey);

        $comment = $this->getCommentById($id);
        $comment->user = $this->getCommentUserById($id);
        return $comment;
    }

    /**
     * Delete a comment.
     *
     * @param $id int
     * @return boolean
     */
    public function deleteComment($id)
    {
        $object = array();
        $wkey["id"] = $id;
        $ret = $this->delete($wkey);
        return $ret;
    }

    /**
     * Get a comment by comment id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCommentById($id)
    {
        return \DB::table($this->getTableName())
            ->where($this->getTableName().'.id', $id)
            ->first();
    }

    /**
     * Get a comment user by comment id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCommentUserById($id)
    {
        return \DB::table($this->getTableName())
            ->select('users.*')
            ->join('users', 'users.id', '=', $this->getTableName().'.user_id')
            ->where($this->getTableName().'.id', $id)
            ->first();
    }
}

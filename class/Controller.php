<?php

namespace portalove;

class Controller {
    private $db_handler;
    private $item_to_update;

    public function __construct ($db_handler) {
        $this->db_handler = $db_handler;
    }

    public function printComments() {
        $comments = $this->db_handler->getComments();
        foreach ($comments as $comment) {
            $text = nl2br($comment['text']);

            echo <<<END
                <div class="media-body tm-service-text mb-3">
                    <h2 class="mb-4 tm-content-title">{$comment['nick']}</h2>
                    <p>{$text}</p>
                    <div class="d-flex justify-content-end">
                        <form method="post">
                            <input type="hidden" name="operation" value="update-item" />
                            <input type="hidden" name="id" value="{$comment['id']}" />
                            <input type="hidden" name="nick" value="{$comment['nick']}" />
                            <input type="hidden" name="text" value="{$comment['text']}" />
                            <button type="submit" class="btn btn-sm btn-secondary mr-2">Uprav</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="operation" value="delete" />
                            <input type="hidden" name="id" value="{$comment['id']}" />
                            <button type="submit" class="btn btn-sm btn-secondary">Vymaž</button>
                        </form>
                    </div>
                </div>
END;
        }
    }

    public function createComment($nick, $text) {
        $this->db_handler->createComment($nick, $text);
    }

    public function setItemToUpdate($id, $nick, $text) {
        $this->item_to_update = array('id' => $id, 'nick' => $nick, 'text' => $text);
    }

    public function getItemToUpdate() {
        return $this->item_to_update;
    }

    public function updateComment($id, $text) {
        $this->db_handler->updateComment($id, $text);
    }

    public function removeComment($id) {
        $this->db_handler->removeComment($id);
    }
}

?>

<?php

class Comment extends BaseEntity
{
    private $commentTitle;
    private $commentContent;
    private $dateCreation;
    private $flag;
    private $idRecipe;
    private $idUsers;
    private $idModerator;


    public function getModerator(): ?Moderator
    {
        return $this->getRelatedEntity("Moderator");
    }
    public function setModerator(Moderator $m)
    {
        $this->setRelatedEntity($m);
    }

    public function getUser(): ?Users
    {
        return $this->getRelatedEntity("User");
    }

    public function setUser(Users $user)
    {
        $this->setRelatedEntity($user);
    }

    public function getRecipe(): ?Recipe
    {
        return $this->getRelatedEntity("Recipe");
    }

    public function setRecipe(Recipe $recipe)
    {
        $this->setRelatedEntity($recipe);
    }

    public function getImage(): ?Image
    {
        return $this->getRelatedEntity("Image");
    }

    public function setImage(Image $i)
    {
        $this->setRelatedEntity($i);
    }


    /**
     * Get the value of commentTitle
     */
    public function getCommentTitle()
    {
        return $this->commentTitle;
    }

    /**
     * Set the value of commentTitle
     *
     * @return  self
     */
    public function setCommentTitle($commentTitle)
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    /**
     * Get the value of commentContent
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Set the value of commentContent
     *
     * @return  self
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;

        return $this;
    }

    /**
     * Get the value of dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get the value of flag
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set the value of flag
     *
     * @return  self
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    public function getFormatedDate()
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        return utf8_encode(ucwords(strftime(" %d %B %G %Hh%M", strtotime($this->getDateCreation()))));
    }

    public function getState($entity)
    {

        if ($entity->getFlag() == "a") {
            $state = "Approuvé";
        } else if ($entity->getFlag() == "w") {
            $state = "En attente";
        } else {
            $state = "Bloqué";
        }
        return $state;
    }

    /**
     * Get the value of idRecipe
     */
    public function getIdRecipe()
    {
        return $this->idRecipe;
    }

    /**
     * Set the value of idRecipe
     *
     * @return  self
     */
    public function setIdRecipe($idRecipe)
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    /**
     * Get the value of idUser1
     */
    public function getIdModerator()
    {
        return $this->idModerator;
    }

    /**
     * Set the value of idUser1
     *
     * @return  self
     */
    public function setIdModerator($idModerator)
    {
        $this->idModerator = $idModerator;

        return $this;
    }

    /**
     * Get the value of idUsers
     */ 
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * Set the value of idUsers
     *
     * @return  self
     */ 
    public function setIdUsers($idUsers)
    {
        $this->idUsers = $idUsers;

        return $this;
    }
}

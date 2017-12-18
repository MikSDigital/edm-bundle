<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * Document entity.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Entity
 * @ORM\Entity(repositoryClass="WBW\Bundle\EDMBundle\Repository\DocumentRepository")
 * @ORM\Table(
 *   name="edm_document",
 *   options={"charset":"utf8", "collate":"utf8_general_ci"},
 *   indexes={
 *     @ORM\Index(name="document_idx_parent", columns={"parent_id"})
 *   }
 * )
 */
class Document {

	/**
	 * Childrens.
	 *
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Document", mappedBy="parent")
	 */
	private $childrens;

	/**
	 * Created at.
	 *
	 * @var DateTime
	 * @ORM\Column(name="created_at", type="datetime", nullable=false)
	 * @Assert\NotNull(message="document.createdAt.notNull.message")
	 */
	private $createdAt;

	/**
	 * Parent.
	 *
	 * @var Document
	 * @ORM\ManyToOne(targetEntity="Document", inversedBy="childrens")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 * })
	 */
	private $parent;

	/**
	 * Id.
	 *
	 * @var int
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * Name.
	 *
	 * @var string
	 * @ORM\Column(name="name", type="string", length=45, nullable=false)
	 * @Assert\NotNull(message="document.name.notNull.message")
	 * @Assert\Length(
	 *   max=45,
	 *   maxMessage="document.name.length.maxMessage"
	 * )
	 */
	private $name;

	/**
	 * Size.
	 *
	 * @var integer
	 * @ORM\Column(name="size", type="integer")
	 * @Assert\NotNull(message="document.size.notNull.message")
	 * @Assert\Range(
	 *   min=0,
	 *   minMessage="document.size.range.minMessage"
	 * )
	 */
	private $size;

	/**
	 * Updated at.
	 *
	 * @var DateTime
	 * @ORM\Column(name="updated_at", type="datetime", nullable=true)
	 */
	private $updatedAt;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->childrens = new ArrayCollection();
	}

	/**
	 * Add a children.
	 *
	 * @param Document $children The children.
	 * @return Document Returns the document.
	 */
	public function addChildren(Document $children) {
		$this->childrens[] = $children;
		return $this;
	}

	/**
	 * Get the childrens.
	 *
	 * @return Collection Returns the childrens.
	 */
	public function getChildrens() {
		return $this->childrens;
	}

	/**
	 * Get the created at.
	 *
	 * @return DateTime Returns the created at.
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Get the id.
	 *
	 * @return integer Returns the id.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Get the name.
	 *
	 * @return string Returns the name.
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the path.
	 *
	 * @return string Returns the path.
	 */
	public function getPath() {

	}

	/**
	 * Get the parent.
	 *
	 * @return Document Returns the parent.
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Get the size.
	 *
	 * @return integer Returns the size.
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Get the updated at.
	 *
	 * @return DateTime Returns the updated at.
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * Remove a children.
	 *
	 * @param Document $children The children.
	 * @return Document Returns the document.
	 */
	public function removeChildren(Document $children) {
		$this->childrens->removeElement($children);
		return $this;
	}

	/**
	 * Set the created.
	 *
	 * @param DateTime $createdAt The created.
	 * @return Document Returns the document.
	 */
	public function setCreatedAt(DateTime $createdAt) {
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * Set the parent.
	 *
	 * @param Document $parent The parent.
	 * @return Document Returns the document.
	 */
	public function setParent(Document $parent = null) {
		$this->parent = $parent;
		return $this;
	}

	/**
	 * Set the name.
	 *
	 * @param string $name The name.
	 * @return Document Returns the document.
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Set the size.
	 *
	 * @param integer $size The size.
	 * @return Document Returns the document.
	 */
	public function setSize($size) {
		$this->size = $size;
		return $this;
	}

	/**
	 * Set the updated at.
	 *
	 * @param DateTime $updatedAt The updated at.
	 * @return Document Returns the document.
	 */
	public function setUpdatedAt(DateTime $updatedAt) {
		$this->updatedAt = $updatedAt;
		return $this;
	}

}
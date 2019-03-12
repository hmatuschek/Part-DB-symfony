<?php declare(strict_types=1);
/**
 *
 * Part-DB Version 0.4+ "nextgen"
 * Copyright (C) 2016 - 2019 Jan Böhmer
 * https://github.com/jbtronics
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
 *
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AttachmentType
 * @package PartDB\Models
 * @ORM\Entity()
 * @ORM\Table(name="attachement_types")
 */
class AttachmentType extends StructuralDBElement
{
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="attachement_type")
     */
    protected $attachments = null;


    /**
     * @ORM\OneToMany(targetEntity="AttachmentType", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="AttachmentType", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * Get all attachements ("Attachement" objects) with this type
     *
     * @return Attachment[]        all attachements with this type, as a one-dimensional array of Attachement-objects
     *                      (sorted by their names)
     *
     */
    public function getAttachementsForType() : ArrayCollection
    {
        // the attribute $this->attachements is used from class "AttachementsContainingDBELement"
        if ($this->attachments == null) {
            $this->attachments = new ArrayCollection();
        }

        return $this->attachments;
    }

    /**
     * Returns the ID as an string, defined by the element class.
     * This should have a form like P000014, for a part with ID 14.
     * @return string The ID as a string;
     */
    public function getIDString(): string
    {
        return "";
        //return 'AT' . sprintf('%09d', $this->getID());
    }
}
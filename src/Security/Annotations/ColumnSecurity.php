<?php
/**
 *
 * part-db version 0.1
 * Copyright (C) 2005 Christoph Lechner
 * http://www.cl-projects.de/
 *
 * part-db version 0.2+
 * Copyright (C) 2009 K. Jacobs and others (see authors.php)
 * http://code.google.com/p/part-db/
 *
 * Part-DB Version 0.4+
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

namespace App\Security\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 *
 * @Annotation\Target("PROPERTY")
 *
 * With these annotation you can restrict the access to certain coloumns in entities.
 * The entity which should use this class has to use ElementListener as EntityListener.
 *
 * @package App\Annotations
 */
class ColumnSecurity
{
    /**
     * @var string The name of the edit permission
     */
    public $edit = "edit";
    /**
     * @var string The name of the read permission
     */
    public $read = "read";

    /**
     * @var string A prefix for all permission names (e.g. $prefix.edit, useful for Parts)
     */
    public $prefix = '';

    /**
     * @var string The placeholder that should be used, when the access to the property is denied.
     */
    public $placeholder = null;

    public $subject = null;

    /**
     * @var string The name of the property. This is used to determine the default placeholder.
     * @Annotation\Enum({"integer", "string", "object"})
     */
    public $type = 'string';

    public function getReadOperationName() : string
    {
        if($this->prefix !== '') {
            return $this->prefix . '.' . $this->read;
        }
        return $this->read;
    }

    public function getEditOperationName() : string
    {
        if($this->prefix !== '') {
            return $this->prefix . '.' . $this->edit;
        }

        return $this->edit;
    }

    public function getPlaceholder()
    {
        if($this->placeholder === null)
        {
            switch($this->type)
            {
                case 'integer':
                    return 0;
                case 'string':
                    return '???';
                case 'object':
                    return null;
            }
        }

        return $this->placeholder;
    }

}
<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformAdminUi\Form\Data\Location;

use eZ\Publish\API\Repository\Values\Content\Location;

/**
 * @todo add validation
 */
class LocationUpdateData
{
    /** @var Location|null */
    protected $location;

    /** @var string|null */
    protected $sortField;

    /** @var string|null */
    protected $sortOrder;

    /**
     * @param Location|null $location
     * @param string|null $sortField
     * @param string|null $sortOrder
     */
    public function __construct(?Location $location = null, string $sortField = null, string $sortOrder = null)
    {
        $this->location = $location;
        $this->sortField = $sortField;
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location|null $location
     */
    public function setLocation(?Location $location)
    {
        $this->location = $location;
    }

    /**
     * @param null|string $sortField
     *
     * @return LocationUpdateData
     */
    public function setSortField($sortField): LocationUpdateData
    {
        $this->sortField = $sortField;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSortField()
    {
        return $this->sortField;
    }

    /**
     * @param null|string $sortOrder
     *
     * @return LocationUpdateData
     */
    public function setSortOrder($sortOrder): LocationUpdateData
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

}
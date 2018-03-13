<?php

namespace NethServer\Module\Alerts;

/*
 * Copyright (C) 2017 Nethesis S.r.l.
 * 
 * This script is part of NethServer.
 * 
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
 */

use Nethgui\System\PlatformInterface as Validate;

/**
 * Change alerts configuration
 *
 */
class Configure extends \Nethgui\Controller\Table\AbstractAction
{

    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('AlertsAutoUpdates', Validate::SERVICESTATUS, array('configuration', 'subscription', 'AlertsAutoUpdates'));
    }

    public function process()
    {
        if ($this->getRequest()->isMutation()) {
            $configDb = $this->getPlatform()->getDatabase('configuration');
            $configDb->setProp('subscription', array('AlertsAutoUpdates' => $this->parameters['AlertsAutoUpdates']));
            $this->getPlatform()->signalEvent('nethserver-alerts-save');
        }
    }

}

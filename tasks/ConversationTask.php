<?php

/*
|--------------------------------------------------------------------------------------
|  Task File
|--------------------------------------------------------------------------------------
|
| This file basically registers a new task to be executed by Crunz
| To get the list of all frequency and constraint method, you may
| go to this link: https://github.com/lavary/crunz#scheduling-frequency-and-constraints
|
*/

use Crunz\Schedule;

require('/var/www/html/jacktrade/jtrade_common/api/common.php');
require('/var/www/html/jacktrade/jtrade_common/server/constants/DBConstants.php');
require('/var/www/html/jacktrade/jtrade_common/server/model/Model.php');
require('/var/www/html/jacktrade/jtrade_common/server/model/Conversation.php');
require('/var/www/html/jacktrade/jtrade_common/server/util/DatabaseUtil.php');
require('/var/www/html/jacktrade/jtrade_common/server/util/MongoDateUtil.php');
require('/var/www/html/jacktrade/jtrade_common/server/constants/ConversationConstants.php');
require('/var/www/html/jacktrade/jtrade_common/server/service/ConversationService.php');

$scheduler = new Schedule();

$scheduler->run(\jtrade_common\server\service\ConversationService::cronFutureConversation())
    ->description('Future conversation will be handled by this cron job')
    ->everyMinute()
    ->preventOverlapping();

$scheduler->run(\jtrade_common\server\service\ConversationService::cronNowConversation())
    ->description('All conversation except Future will be handled by this cron job')
    ->everyMinute()
    ->preventOverlapping();


return $scheduler;
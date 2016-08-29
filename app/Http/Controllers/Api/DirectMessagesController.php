<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\DirectMessages;
use PhpParser\Node\Scalar\MagicConst\Dir;

class DirectMessagesController extends Abstraction
{
    public function postDestroy(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::destroy($input);

        return self::output($body);
    }

    public function getConversation(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::conversation($input);

        return self::output($body);
    }

    public function postNew(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::news($input);

        return self::output($body);
    }

    public function getConversationList(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::conversation_list($input);

        return self::output($body);
    }

    public function getInbox(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::inbox($input);

        return self::output($body);
    }

    public function getSent(Request $request)
    {
        $input = $request->all();
        $body = DirectMessages::sent($input);

        return self::output($body);
    }
}

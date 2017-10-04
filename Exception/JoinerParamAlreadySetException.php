<?php

namespace Mager\Joiner\Exception;

use Exception;

class JoinerParamAlreadySetException extends Exception
{
    const COLLECTION = 'collection';
    const JOIN_TABLE_NAME = 'join table name';
    const JOIN_TABLE_ALIAS = 'join table alias';
    const JOIN_TYPE = 'join type';
    const JOIN_ON = 'join on';
    const JOIN_WHERE = 'join where';
    const JOIN_SELECT_FIELDS = 'join select fields';
}
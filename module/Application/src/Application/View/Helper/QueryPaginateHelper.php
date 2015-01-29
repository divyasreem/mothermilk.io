<?php
 
/*
* This was designed to take current query string values from your URI and add them to the next page during pagination
*/
 
namespace Application\View\Helper;
 
use Zend\View\Helper\AbstractHelper;
 
class QueryPaginateHelper extends AbstractHelper
{
    public function __invoke($data)
    {

        unset($data['page']);
        if (! empty($data)) {
            return  '&'.http_build_query($data);
        }
    }
}
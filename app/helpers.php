<?php
function layout()
{
    return \Request::is('app/company*') ? 'app.company.layouts.company' : 'app.athlete.layouts.athlete';
}

function isCoach()
{
    return \Request::is('coach/*') ? true : false;
}
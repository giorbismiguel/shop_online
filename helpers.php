<?php

function format_money($value)
{
    return number_format($value, 2, '.', ',');
}

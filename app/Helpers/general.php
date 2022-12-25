<?php

/**
 * @return string
 */
function getFolder(){
    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';
}

<?php

    namespace Config;

    class Config {

        const BASE_URL		= '/';
        const BASE_PATH     = '/';
        const DOMAIN        = 'localhost';
        const DEFAULT_LOCALE= 'en';

        const NEO_HOST      = $_ENV['DB_HOST'];
        const NEO_PORT      = $_ENV['DB_PORT'];
        const NEO_USERNAME      = 'website-connection-aws';
        const NEO_PASSWORD  = $_ENV['DB_PASS'];

        const CROSSBAR_WS_PORT      = _CROSSBAR_WS_PORT;  // 8080/
        const CROSSBAR_WS_URL       = _CROSSBAR_WS_URL;  // ws://127.0.0.1:8080/ws
        const CROSSBAR_REDIRECT_URL = _BASE_URL;

        const DEBUG         = false;

        const CAP_IDEAL_MAX     = 8;
        const CAP_ALERT         = 12;
        const CAP_NO_MORE       = 16;
        const CAP_MAX_CHILD     = 25;

        const MANDRILL_KEY  = 'glIy6VMjJB5qi32A1a5qSg';

        const GOOGLE_TRANSLATE_API_KEY = $_ENV['GT_API'];

        const VANILLA_URL	= 'http://vanilla.skill-project.org/;

        const GA_ACCOUNT = 'UA-12349595';

        const GETTEXT_DIRECTORY = "gettext";
    }

<?php

if (!enum_exists("PlatformEnum")) {
    enum PlatformEnum
    {
        case NULL;
        case ANDROID;
        case CHROME_OS;
        case CHROMIUM_OS;
        case IOS;
        case LINUX;
        case MACOS;
        case WINDOWS;
        case UNKNOWN;
    }
}

<?php
// verifier qu'on n'a pas deja creer l'enum
if (!enum_exists("PlatformEnum")) {

    /**
     * Enum pour les noms de plateforme.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
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

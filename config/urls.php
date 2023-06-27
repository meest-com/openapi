<?php

return [
    'auth' => [
        'getToken' => '/auth',
        'refreshToken' => '/refreshToken',
    ],
    'search' => [
        'country' => '/countrySearch',
        'region' => '/regionSearch',
        'district' => '/districtSearch',
        'city' => '/citySearch',
        'zipCode' => '/zipCodeSearch/{zipCode}',
        'address' => '/addressSearch',
        'types' => '/branchTypes',
        'branch' => '/branchSearch',
        'pudoSearchMWL' => '/pudoSearchMWL/{search}',
        'terminal' => '/payTerminalSearch/{latitude}/{longitude}',
        'contract' => '/getContractID',
    ],
    'parcel' => [
        'show' => '/parcelInfo/{parcelID}',
        'get' => '/getParcel/{parcelID}/{searchMode}/{returnMode}',
        'create' => '/parcel',
        'update' => '/parcel/{parcelID}',
        'delete' => '/parcel/{parcelID}/{contractID}',
        'list' => '/parcelsList/{dateFrom}',
        'calculate' => '/calculate',
        'packTypes' => '/packTypes',
        'specConditions' => '/specConditions',
        'info4Sticker' => '/info4Sticker/{parcelID}',
        'photoFixation' => '/photoFixation/{number}',
        'LockParcel' => '/LockParcel',
        'UnlockParcel' => '/UnlockParcel',
        'sticker' => '/stickerAll/{parcelID}'
    ],
    'register' => [
        'branch' => [
            'create' => '/registerBranch',
            'update' => '/registerBranch/{registerID}',
            'delete' => '/registerBranch/{registerID}',
        ],
        'pickup' => [
            'create' => '/registerPickup',
            'update' => '/registerPickup/{registerID}',
            'delete' => '/registerPickup/{registerID}',
        ],
        'list' => '/registersList/{dateFrom}',
    ],
    'print' => [
        'declaration' => '/print/declaration/{printValue}/{contentType}',
        'register' => '/print/register/{printValue}/{contentType}',
        'cn23' => '/print/cn23/{printValue}/{contentType}',
        'sticker' => '/print/sticker/{printValue}/{contentType}/{termoprint}',
        'sticker100' => '/print/sticker100/{printValue}',
    ],
    'tracking' => [
        'get' => '/tracking/{trackNumber}',
        'delivered' => '/trackingDelivered/{dateFrom}/{dateTo}/{page}',
        'events' => '/trackingByDate/{searchDate}',
        'byNumber' => '/trackByNumber/{trackNumber}',
    ],
    'export' => [
        'service' => '/exportCountriesFromUkraine',
        'calculateExport' => '/calculateExportParcel',
        'calculateStandard' => '/calculateStandard',
    ],
];

<?php

namespace SB\Site\ExchangeLog\Enums;


enum ExchangeSystem: string
{
    case SAP = 'SAP ECC';
    case B24 = 'Bitrix 24';

    public function getValue(): string
    {
        return $this->value;
    }
}

enum ExchangeType: string
{
    case Inbound = 'Inbound';
    case Outbound = 'Outbound';

    public function getValue(): string
    {
        return $this->value;
    }
}

enum ExchangeInterface: string
{
    case CustomerMaster  = 'Customer Master SAP ECC';
    case CustomerHierarchy = 'Customer Hierarchy SAP ECC';
    case CustomerContract  = 'Customer Contract SAP ECC';
    case DataEnrichment = 'Data Enrichment Export (Auto)';
    case ForMacros = 'For Macros (auto)';

    public function getValue(): string
    {
        return $this->value;
    }
}

enum ExchangeLastStatus: string
{
    case Ok = 'OK';
    case Error = 'ERROR';
    case NoData = 'NO_DATA';

    public function getValue(): string
    {
        return $this->value;
    }
}
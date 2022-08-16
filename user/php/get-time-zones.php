<?php
date_default_timezone_set("Asia/Bangkok");
//--------------------------------------------------------------------------------------------------
// This script outputs a JSON array of all timezones (like "America/Chicago") that PHP supports.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
// echo date_default_timezone_set('Asia/Bangkok');/
echo json_encode(DateTimeZone::listIdentifiers());
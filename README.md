# Magento 2 Log Viewer

[![Magento 2](https://img.shields.io/badge/Magento-2.4.x-orange.svg)](https://magento.com/)
[![PHP](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%20%7C%208.3-blue.svg)](https://php.net/)


Real-time log monitoring and analysis tool for Magento 2 admin panel.

## Overview

In enterprise environments, comprehensive log analysis and monitoring solutions like **New Relic**, **Datadog**, **Splunk**, **ELK Stack (Elasticsearch, Logstash, Kibana)**, and **Sentry** are essential for tracking application performance, errors, and system health. These powerful platforms provide deep insights, real-time alerting, and advanced analytics capabilities.
However, there are many real-world cases where access to such tools is limited, delayed, or entirely unavailable — especially during urgent debugging or in cost-sensitive environments.

**Magento 2 Log Viewer** bridges this gap by providing a lightweight, built-in solution for real-time log monitoring directly within the Magento admin panel. While it doesn't replace comprehensive monitoring platforms, it serves as an invaluable complementary tool for immediate log analysis and debugging.

## Features

### 🎯 Core Capabilities

- **Real-time Log Streaming** - View log updates as they happen with auto-refresh functionality
- **Multiple Log File Support** - Switch between different Magento log files (system.log, exception.log, debug.log, etc.)
- **Customizable Refresh Intervals** - Choose from 5 seconds to 5 minutes for auto-refresh
- **Error Filtering** - Focus on critical issues with error-only view mode
- **Adjustable Line Limits** - Display 50 to 500 lines for optimal performance
- **Auto-scroll to Bottom** - Always see the latest log entries first
- **Manual Refresh** - Update logs on-demand with a single click
- **Clear Display** - Clean the log view without affecting actual log files

## Installation

### Via Composer

```
composer require mustafa/module-log-viewer
php bin/magento module:enable Mustafa_LogViewer
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

## Configuration

### Access Control

The module respects Magento's ACL (Access Control List) system. To grant access:

1. Navigate to **System > User Roles**
2. Select the role you want to configure
3. In Role Resources, expand **Mustafa** > **Log Viewer**
4. Check **Access Log Viewer**
5. Save the role

## Usage

### Accessing the Log Viewer

1. Log in to Magento Admin Panel
2. Navigate to **System > Tools > Log Viewer**
3. The log viewer interface will load with the latest 100 log entries

### Basic Operations

#### Viewing Logs
- Select desired log file from **Log File** dropdown
- Adjust number of lines with **Lines** dropdown (50, 100, 200, 500)
- Click **Refresh** button to manually update the display

#### Auto-Refresh Mode
1. Select refresh interval from **Auto Refresh Time** dropdown:
   - 5 seconds (real-time monitoring)
   - 15 seconds (balanced)
   - 30 seconds (moderate)
   - 1 minute (light monitoring)
   - 5 minutes (periodic checks)

2. Click **Auto Refresh: OFF** button to enable
3. Button changes to **Auto Refresh: ON** with primary color
4. Logs will update automatically at the selected interval
5. Change refresh interval on-the-fly without stopping auto-refresh
6. Click **Auto Refresh: ON** to disable automatic updates

#### Error-Only Mode
- Check **Errors Only** checkbox to filter:
  - ERROR level logs
  - CRITICAL level logs
  - Exceptions
  - Fatal errors

#### Clear Display
- Click **Clear Display** to remove current view
- Note: This only clears the interface, not the actual log files

### Use Cases

#### Development Debugging
```
Scenario: Testing a new payment integration
1. Enable Auto Refresh (5 seconds)
2. Check "Errors Only"
3. Perform test transaction
4. Watch for real-time errors or exceptions
```

#### Production Monitoring
```
Scenario: Monitoring critical operation during deployment
1. Select system.log
2. Set refresh to 15 seconds
3. Enable Auto Refresh
4. Monitor for any unexpected errors
```

## Comparison with Enterprise Solutions

| Feature | Log Viewer | New Relic | Datadog | Splunk | ELK Stack |
|---------|------------|-----------|---------|--------|-----------|
| Real-time Monitoring | ✅ | ✅ | ✅ | ✅ | ✅ |
| Historical Analysis | ❌ | ✅ | ✅ | ✅ | ✅ |
| Alerting | ❌ | ✅ | ✅ | ✅ | ✅ |
| Log Aggregation | ❌ | ✅ | ✅ | ✅ | ✅ |
| Custom Dashboards | ❌ | ✅ | ✅ | ✅ | ✅ |
| APM Integration | ❌ | ✅ | ✅ | ✅ | ✅ |
| Cost | Free | $$$ | $$$ | $$$$ | $$ |
| Setup Complexity | Low | Medium | Medium | High | High |
| Admin Panel Access | ✅ | ❌ | ❌ | ❌ | ❌ |
| No External Dependency | ✅ | ❌ | ❌ | ❌ | ❌ |
| Immediate Availability | ✅ | ❌ | ❌ | ❌ | ❌ |

## Requirements

- Magento 2.4.x or higher
- PHP 8.1, 8.2, or 8.3
- Read permissions on `var/log/` directory
- Admin panel access with appropriate ACL permissions

## Compatibility

- ✅ Magento Open Source 2.4.x
- ✅ Adobe Commerce 2.4.x
- ✅ Cloud Edition (with proper file system access)
- ✅ Multi-store setups
- ✅ Production, Staging, and Development modes

## Author

**Mustafa.Aydoğan**
- Module: mustafa/module-log-viewer
- Version: 1.0.0

## Acknowledgments
--

This module is designed for convenience and immediate access, not as a replacement for proper enterprise monitoring solutions. For production environments, always maintain comprehensive logging infrastructure with tools like New Relic, Datadog, or ELK Stack, and use this module as a supplementary debugging tool.


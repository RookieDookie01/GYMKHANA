<?php
function escapeString($value) {
    global $mysqli;
    if (is_array($value)) {
        foreach ($value as &$element) {
            $element = escapeString($element);
        }
        unset($element);
    } else {
        $value = trim($value);
        $value = $mysqli->real_escape_string($value);
    }

    return $value;
}

function arrayCheck($array) {
    $booleanArray = false;
    if ($array !== null && is_array($array) && sizeof($array) > 0) {
        $booleanArray = true;
    }
    return $booleanArray;
}

function getStatusBadgeClass($paymentStatus) {
    switch ($paymentStatus) {
        case 'Approve':
            return 'bg-success';
        case 'Pending':
            return 'bg-warning status';
        case 'Paid':
            return 'bg-info status';
        case 'Failed':
            return 'bg-danger status';
        case 'Refunded':
            return 'bg-primary';
        case 'Cancelled':
        default:
            return 'bg-secondary';
    }
}

function getDifferenceDate($dateDifference){
    if ($dateDifference->y > 0) {
        return $dateDifference->y . ' years ago';
    } elseif ($dateDifference->d > 0) {
        return $dateDifference->d . ' days ago';
    } elseif ($dateDifference->h > 0) {
        return $dateDifference->h . ' hours ago';
    } elseif ($dateDifference->i > 0) {
        return $dateDifference->i . ' minutes ago';
    } else {
        return 'Just now';
    }
}
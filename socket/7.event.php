<?php
/**
 * Created by PhpStorm.
 * User: vaniot
 * Date: 18-3-26
 * Time: 下午1:34
 */


$fd = stream_socket_server("tcp://127.0.0.1:8030", $errno, $errstr);

stream_set_blocking($fd, 0);

$event_base = new EventBase();

$event = new Event($event_base, $fd, Event::READ | Event::PERSIST, function ($fd) use (&$event_base) {
    $conn = stream_socket_accept($fd);

    fwrite($conn, "HTTP/1.0 200 OK\r\nContent-Length: 2\r\n\r\nHi");
    fclose($conn);
}, $fd);

$event->add();

$event_base->loop();

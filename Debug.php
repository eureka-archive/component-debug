<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Debug;

/**
 * Debug helper class
 *
 * @author Romain Cottard
 * @version 2.1.0
 */
class Debug
{

    /**
     *  Display message (more graphical than 'echo()' )
     *
     * @param      string  $message Message to display.
     * @param      string  $title 'Title' for message.
     * @param      boolean $exit If exit after displayed message.
     * @return     void
     */
    static public function _echo($message, $title = '', $exit = false)
    {
        if (PHP_SAPI !== 'cli') {

            $title = 'DISPLAY ' . $title;
            echo '<div style="border: 1px solid black;">';
            echo '<div style="border-bottom: 1px solid black; background-color: #CCCCCC;">' . $title . '</div>';
            echo '<div style="background-color: #EEEEEE;"><pre>' . $message . '</pre></div>';
            echo '</div>';

        } else {

            if (!empty($title)) {
                $title .= ' = ';
            }
            echo $title . $message . PHP_EOL;
        }

        if (true === $exit) {
            exit(0);
        }
    }

    /**
     *  Display message (more graphical than 'echo()' )
     *
     * @param      string  $message Message to display.
     * @param      string  $title 'Title' for message.
     * @return     void
     */
    static public function _echox($message, $title = '')
    {
        self::_echo($message, $title, true);
    }

    /**
     * Display message (more graphical than 'var_export()' )
     *
     * @param  string $var Message to display.
     * @param  string $title 'Title' for message.
     * @return void
     */
    static public function htmlTable($var, $title = '')
    {
        if ('' != $title) {

            $title = 'DISPLAY ' . $title;
            echo '<div style="border: 1px solid black;">';
            echo '<div style="border-bottom: 1px solid black; background-color: #CCCCCC;">' . $title . '</div>';
            echo '<div style="background-color: #EEEEEE;">';
            echo '<table>';
            self::htmlTable($var);
            echo '</table>';
            echo '</div>';
            echo '</div>';

        } else {

            if (is_array($var)) {
                echo '<tr>';
                foreach ($var as $index => $newVar) {
                    echo '<td>' . $index . '</td>';
                    self::htmlTable($newVar);
                }
                echo '</tr>';
            } else {
                echo '<td>' . $var . '</td>';
            }
        }
    }

    /**
     *  Display message (more graphical than 'var_export()' )
     *
     * @param  string  $var Message to display.
     * @param  string  $title 'Title' for message.
     * @param  boolean $exit If exit after displayed message.
     * @return void
     */
    static public function _var_export($var, $title = '', $exit = false)
    {
        if (PHP_SAPI !== 'cli') {
            $title = 'DISPLAY ' . $title;
            echo '<div style="border: 1px solid black;">';
            echo '<div style="border-bottom: 1px solid black; background-color: #CCCCCC;">' . $title . '</div>';
            echo '<div style="background-color: #EEEEEE;"><pre>', var_export($var, true), '</pre></div>';
            echo '</div>';
        } else {
            if ('' != $title) {
                $title .= ' = ';
            }
            echo $title . var_export($var, true) . PHP_EOL;
        }

        if (true === $exit) {
            exit(0);
        }
    }

    /**
     *  Display message (more graphical than 'var_export()' ) and exit.
     *
     * @param  string  $var Message to display.
     * @param  string  $title 'Title' for message.
     * @return void
     */
    static public function _var_exportx($var, $title = '')
    {
        self::_var_export($var, $title, true);
    }

    /**
     * Display message (more graphical than 'var_dump()' )
     *
     * @param  string  $var Message to display.
     * @param  string  $title 'Title' for message.
     * @param  boolean $exit If exit after displayed message.
     * @return void
     */
    static public function _var_dump($var, $title = '', $exit = false)
    {
        if (PHP_SAPI !== 'cli') {

            $title = 'DISPLAY ' . $title;
            echo '<div style="border: 1px solid black;">';
            echo '<div style="border-bottom: 1px solid black; background-color: #CCCCCC;">' . $title . '</div>';
            echo '<div style="background-color: #EEEEEE;"><pre>';
            var_dump($var);
            echo '</pre></div>';
            echo '</div>';
        } else {
            if ('' != $title) {
                $title .= ' = ';
            }
            echo $title;
            var_dump($var);
            echo PHP_EOL;
        }

        if (true === $exit) {
            exit(0);
        }
    }

    /**
     *  Display message (more graphical than 'var_dump()' ) and exit.
     *
     * @param  string  $var Message to display.
     * @param  string  $title 'Title' for message.
     * @param  boolean $html If message is displayed in HTML or not.
     * @return void
     */
    static public function _var_dumpx($var, $title = '', $html = true)
    {
        self::_var_dump($var, $title, true);
    }

    /**
     *  Display message (more graphical than 'var_dump()' )
     *
     * @return void
     */
    static public function batchmsg()
    {
        if (0 == func_num_args()) {
            return;
        }

        $args    = func_get_args();
        $message = '';

        foreach ($args as $msg) {
            $message .= ' ' . $msg;
        }

        self::_echo($message);
    }

}

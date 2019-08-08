<?php

class Pager {

    public static function obterDe($total, $page, $limit) {
        if (!$page) {
            return 0;
        }
        if (!$total) {
            return 0;
        }
        $result = (($page - 1) * $limit) + 1;
        if ($result == 0) {
            return 1;
        }
        return $result;
    }

    public static function obterPara($total, $page, $limit) {
        if (!$page) {
            $page = 1;
        }
        $n = $page * $limit;
        if ($n > $total) {
            return $total;
        }
        return $n;
    }

    public static function render($base_url, $total, $page, $limit = null, $max_visible = 6, $titles = array(), $noempty = false, $page_var = 'p') {
        if (!$total) {            
            return '';
        }
        self::_filtrar($total, $page, $limit);

        $pages = ceil($total / $limit);

        if ($noempty && ($pages < 2)) {            
            return '';
        }

        if ($page > $pages) {
            $page = $pages;
        }

        $parsedUrl = parse_url($base_url);
        $q = array();
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $q);
        }
        $q[$page_var] = '';

        if (isset($parsedUrl['fragment'])) {
            $fragment = '#' . $parsedUrl['fragment'];
        } else {
            $fragment = null;
        }
        
        $defaultTitles = array(
            'first' => 'Primeira', 
            'previous' => 'Anterior', 
            'next' => 'Próxima', 
            'last' => 'Última'
            );
        $titles = array_merge($defaultTitles, $titles);

        $url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
        $paginas = array();

        $disabledCounter = 1;

        if ($page <= 1) {
            $paginas['disabled-' . $disabledCounter++] = '<a href="#">' . $titles['first'] . '</a>';
            $paginas['disabled-' . $disabledCounter++] = '<a href="#">' . $titles['previous'] . '</a>';
        } else {
			$q['page'] = 1;
			$url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
            $paginas[] = '<a href="' . $url . '">' . $titles['first'] . '</a>';
			
			$q['page'] = $page-1;
			$url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
            $paginas[] = '<a href="' . $url . '">' . $titles['previous'] . '</a>';
        }
        
        $diff = (int) !($max_visible % 2);

        if ($diff) {
            $half = ceil($max_visible / 2);
        } else {
            $half = floor($max_visible / 2);
        }


        $slide = $half - $diff;

        $inicial = $page - $slide;
        $final = $page + $slide + $diff;

        if ($inicial <= 1) {
            if ($inicial != 1) {
                $inicial = abs($inicial) + 1;
            } else {
                $inicial = 0;
            }
            $final += $inicial;
            $inicial = 1;
        }

        if ($final >= $pages) {
            $inicial -= $final - $pages;
            $final = $pages;
        }

        if ($inicial < 1) {
            $inicial = 1;
        }

        for ($i = $inicial; $i <= $final; $i++) {
            if ($i == $page) {
                $paginas['atual'] = '<a href="#">' . $i . '</a>';
            } else {
				$q['page'] = $i;
				$url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
                $paginas[] = '<a href="' . $url . '">' . $i . '</a>';
            }
        }


        if ($page == $pages) {
            $paginas['disabled-' . $disabledCounter++] = '<a href="#">' . $titles['next'] . '</a>';
            $paginas['disabled-' . $disabledCounter++] = '<a href="">' . $titles['last'] . '</a>';
        } else {
			$q['page'] = $page+1;
			$url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
            $paginas[] = '<a href="' . $url . '">' . $titles['next'] . '</a>';
			$q['page'] = $pages;
			$url = $parsedUrl['path'] . '?' . http_build_query($q) . $fragment;
            $paginas[] = '<a href="' . $url . '">' . $titles['last'] . '</a>';
        }

        $first = 'first';
        $last = 'last';
        
        $previous = 'previous';
        $next = 'next';
        
        $class = '';
        $saida = '';
        $counter = 1;
        $count = count($paginas);
        $atual = 1;
        $total = 0;
        foreach ($paginas as $k => $v) {
            if (is_numeric($k) || $k == 'atual') {
                $total++;
            }
        }

        foreach ($paginas as $k => $p) {
//                    echo $k . " ->" . $p . "<br>";
            if ($counter == 1) {
                $class .= $first;
            }
            if ($counter == 2) {
                $class .= $previous;
            }
            if ($counter == $count) {
                $class .= $last;
            }
            if ($counter == $count-1) {
                $class .= $next;
            }

            if (is_numeric($k) || $k == 'atual') {
                if ($atual == 1) {
                    $class .= '';
                }
                if ($atual == $total) {
                    $class .= '';
                }
                $atual++;
            }

            if ($k === 'atual') {
                $class .= ' active pagina-atual';
            } elseif (!is_numeric($k)) {
                $class .= ' disabled';
            }

            $saida .= '<li class="' . $class . '">' . $p . '</li>';
            $class = '';
            $counter++;
        }        

        return '<ul class=" quantidade-de-paginas">' . $saida . '</ul>';
    }

    private static function _filtrar(&$total, &$page, &$limit) {
        $total = abs($total);
        $page = abs($page);
        if (!$page) {
            $page = 1;
        }
        $limit = abs($limit);
        if (!$limit) {
            $limit = 20;
        }
    }

}

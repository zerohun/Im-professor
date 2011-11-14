<!DOCTYPE html 
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
  <head>
    <link href="style.css" media="screen" rel="stylesheet" type="text/css" /> 
  </head>
  <body>
  <div id="container">
    <div id="search_bar">
      <ul>
        <li>학교선택:
          <select name="choose_school">
          </select>
        </li>

        <li>학부/과선택:
          <select name="choose_major">
            <option value="0">학교를 먼저 선택해 주세요.</option>
          </select>
        </li>
        <li>교수선택:
          <select name="choose_professor">
            <option value="0">학교 혹은 학과를 먼저 선택해 주세요.</option>
          </select>
        </li>
      </ul>
    </div>
    
    <div id="search_bar">
      <form id="search_form" method="GET">
      <input id="search_text" type="text"/>
      <input id="search_button" type="submit" value="검색"/>
    </div>
    <div id="content">
    

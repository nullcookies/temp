<style>
    
        .search-box input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
            color:    #fff;
        }
        .search-box input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
           color:    #fff;
           opacity:  1;
        }
        .search-box input::-moz-placeholder { /* Mozilla Firefox 19+ */
           color:    #fff;
           opacity:  1;
        }
        .search-box input:-ms-input-placeholder { /* Internet Explorer 10-11 */
           color:    #fff;
        }
        
        .search-box input{
            color: #fff;
        }
</style>


<div class="search-box" style="color:#fff">
  {{Form::open(array('method' => 'get', 'action' => ['Front\Search\SearchController@index']))}}
    <input autocomplete="off" type="text" class="searchProductTextBoxInput placeholder_css" onkeyup="//getSearch(this.value)"  placeholder="What are you looking for?" maxlength="70" name="q" id="search">
    <button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
  {{Form::close()}}
</div>

<div class="search-list" id="searchResult">
</div>
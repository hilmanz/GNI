<div class="page_section" id="dashboard-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-books">&nbsp;</span> Master Data &raquo; Jabatan</h2>
        </div><!-- end .titlebox -->
        <div class="content">
        	<div class="row">
            	<div class="col1">
                    <div id="tabs">
                      <ul>
                        <li><a href="#tabs-1">Form Entry</a></li>
                        <li><a href="#tabs-2">Master Data</a></li>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                        <form class="pure-form pure-form-aligned">
                            <fieldset>
                                <div class="pure-control-group">
                                    <label for="name">Name </label>
                                    <input type="text" placeholder="Name " class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Gender </label>
                                    <select id="state" class="pure-input-1-2" >
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Role </label>
                                    <select id="state" class="pure-input-1-4">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                      <div id="tabs-2" class="tabcontent">
                      <div class="shorter">
                      	<form class="pure-form shortTable">
                        	<span>Show</span>
                                <select id="state">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                    <option>40</option>
                                </select>
                            <span>Entries</span>
                        </form>
                        <form class="pure-form searchBox">
                            <input type="text" class="">
                            <button type="submit" class="pure-button btnSearch"><span class="icon-search">&nbsp;</span></button>
                        </form>
                      </div>
                      <table class="pure-table pure-table-bordered">
                            <thead>
                                <tr>
                                    <th width="1" class="center">No</th>
                                    <th>Name </th>
                                    <th>Gender </th>
                                    <th>Role </th>
                                    <th width="100" class="center">Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td>Acit</td>
                                    <td>Male  </td>
                                    <td>1</td>
                                    <td class="center">
                                    	<a href="#" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                    	<a href="#" class="iconbtn"><span class="icon-trash">&nbsp;</span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="paging">
                        	<a href="#">&laquo;</a>
                        	<a href="#">1</a>
                        	<a href="#">2</a>
                        	<a href="#" class="current">3</a>
                        	<a href="#">4</a>
                        	<a href="#">5</a>
                        	<a href="#">&raquo;</a>
                        </div><!-- end .paging -->
                      </div><!-- end .tabcontent -->
                    </div><!-- end #tabs -->
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->

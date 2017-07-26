<div class="page_section" id="dashboard-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Berita</h2>
        </div><!-- end .titlebox -->
        <div class="content">
        	<div class="row">
            	<div class="col1">
                    <div id="tabs">
                      <ul>
                        <li><a href="#tabs-1">Daftar Berita</a></li>
                        <li><a href="#tabs-2">Entry Baru</a></li>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
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
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Sumber</th>
                                    <th>Author</th>
                                    <th>Lampiran</th>
                                    <th width="100" class="center">Aksi</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td>18 Maret 2014</td>
                                    <td>Perhitungan Lending Rate</td>
                                    <td>Treasury Division</td>
                                    <td>admin</td>
                                    <td>-</td>
                                    <td class="center">
                                    	<a href="#" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                    	<a href="#" class="iconbtn"><span class="icon-trash">&nbsp;</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td>18 Maret 2014</td>
                                    <td>Persiapan Uji Sertifikasi Manajemen Risiko Maret 2014</td>
                                    <td>HR Division</td>
                                    <td>admin</td>
                                    <td>-</td>
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
                      <div id="tabs-2" class="tabcontent">
                        <form class="pure-form pure-form-stacked">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Ketik Judul Berita" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <textarea placeholder="Isi Berita" class="pure-input-2-3 editor" ></textarea>
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Ketik Sumber Berita" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Lampiran</label>
                                    <input type="file" placeholder="Ketik Url File" class="pure-input-2-3" >
                                </div>
                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Submit</button>
                                    <button class="pure-button pure-button-primary">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                    </div><!-- end #tabs -->
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->

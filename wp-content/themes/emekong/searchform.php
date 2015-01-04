<?php echo '<form role="search" method="get" action="' . esc_url(home_url('/')) . '">

                    <div class="search-box">
                        <input type="text" class="textbox" value="' . get_search_query() . '" >
                    </div>
                    <div class="btn-search">
                        <div class="selector" id="uniform-search-group" style="width: 141px;"><span style="width: 141px; -webkit-user-select: none;">Tin Tức</span><select name="search-group" id="search-group">
                                <option value="tintuc">Tin Tức</option>
                                <option value="duandautu">Dự án đầu tư</option>
                                <option value="hotrophaply">Hỗ trợ pháp lý</option>
                                <option value="hoidap">Hỏi - đáp</option>
                            </select></div>
                        <button class="button btn-search" id ="searchsubmit" type="submit">Tìm kiếm</button>
                    </div>
</form>';
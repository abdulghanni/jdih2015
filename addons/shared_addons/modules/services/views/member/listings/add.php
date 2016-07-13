<?php $v =& $this->validation ?>

	<h2>Tambah Produk Hukum</h2>	
	
	<div class="form_error">
		<?=$v->error_string?>
	</div>
	
	<?=form_open_multipart('member/listings/add')?>
		<p>
			<label for="category">* Kategori: </label>
			<select name="category" id="category" class="<?=$v->category_error?>">
				<option value="none">Pilih</option>
				
				<?php foreach($categories as $category): ?>
				<?php $selected = ($category->category_id == $active) ? 'selected="selected"' : '' ?>
				<option value="<?=$category->category_id?>" <?=$selected?>><?=$category->name?></option>
				<?php endforeach ?>
				
			</select>
		</p>
		<p><label for="title">* Nomor: </label><input type="text" name="title" value="<?=$v->title?>" id="title" class="<?=$v->title_error?>" /></p>
		<p><label for="regyear">* Tahun: </label><input type="text" name="regyear" value="<?=$v->regyear?>" id="regyear" class="<?=$v->regyear_error?>" /></p>
		<p><label for="url">* File Download: </label><input type="file" name="url" id="url" class="<?=$v->url_error?>" /></p>
		<p><label for="description">* Tentang: </label><textarea name="description" id="description" class="<?=$v->description_error?>" rows="8" cols="40"><?=$v->description?></textarea></p>
		<p><button type="submit">Simpan</button></p>
	</form>
	
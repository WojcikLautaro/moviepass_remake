<button class="btn btn-outline-success my-2 my-sm-0" <?php if(isset($name)) echo 'name="' . $name . '"'; ?> <?php if(isset($value)) echo 'value="' . $value . '"'; ?> type="submit"><?php echo $text; ?></button>
                                   
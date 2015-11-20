<div class="ls-modal" id="hs-create-customer-modal">
  <div class="ls-modal-box">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title">Criar novo comprador</h4>
    </div>
    <form action="{{ route('customer.create') }}" data-ls-module="form" class="ls-form row" method="post">
      <div class="ls-modal-body" id="hs-crete-customer-modal-body"></div>
      <div class="ls-modal-footer">
        <button class="ls-btn ls-float-right" type="button" data-dismiss="modal"> Fechar </button>
        <button type="submit" class="ls-btn-primary">Criar</button>
      </div>
    </form>
  </div>
</div>

<?php
include("includes/db.php");

if (isset($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];

    $sql_remover_pedido = "DELETE FROM pedidos WHERE id_cliente = $pedido_id";
    $resultado_remover_pedido = $conn->query($sql_remover_pedido);

    if ($resultado_remover_pedido) {
        echo "Pedido enviado com sucesso.";
    } else {
        echo "Erro ao remover o pedido.";
    }
} else {
    echo "Pedido não especificado.";
}
?>

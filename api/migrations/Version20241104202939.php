<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104202939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE api_user ADD trades_person_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE api_user ADD profile_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE api_user ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE api_user ADD CONSTRAINT FK_AC64A0BACEF25CA7 FOREIGN KEY (trades_person_id) REFERENCES trades_person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE api_user ADD CONSTRAINT FK_AC64A0BACCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC64A0BACEF25CA7 ON api_user (trades_person_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC64A0BACCFA12B8 ON api_user (profile_id)');
        $this->addSql('ALTER TABLE authentication_token ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE authentication_token ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE availability ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE availability ALTER tradesperson_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER service_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER tradesperson_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER customer_id TYPE UUID');
        $this->addSql('ALTER TABLE calendar ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE calendar ALTER tradesperson_id TYPE UUID');
        $this->addSql('ALTER TABLE notification ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE notification ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE notification_settings ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE notification_settings ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE payment ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE payment ALTER booking_id TYPE UUID');
        $this->addSql('ALTER TABLE payment_method ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE payment_method ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE profile ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE profile ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER reviewer_id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER reviewee_id TYPE UUID');
        $this->addSql('ALTER TABLE review_response ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE review_response ALTER review_id TYPE UUID');
        $this->addSql('ALTER TABLE review_response ALTER responder_id TYPE UUID');
        $this->addSql('ALTER TABLE service ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE service ALTER category_id TYPE UUID');
        $this->addSql('ALTER TABLE service_category ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE trades_person ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE trades_person ALTER user_id TYPE UUID');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE review_response ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE review_response ALTER review_id TYPE UUID');
        $this->addSql('ALTER TABLE review_response ALTER responder_id TYPE UUID');
        $this->addSql('ALTER TABLE trades_person ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE trades_person ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER service_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER tradesperson_id TYPE UUID');
        $this->addSql('ALTER TABLE booking ALTER customer_id TYPE UUID');
        $this->addSql('ALTER TABLE service ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE service ALTER category_id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER reviewer_id TYPE UUID');
        $this->addSql('ALTER TABLE review ALTER reviewee_id TYPE UUID');
        $this->addSql('ALTER TABLE service_category ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE api_user DROP CONSTRAINT FK_AC64A0BACEF25CA7');
        $this->addSql('ALTER TABLE api_user DROP CONSTRAINT FK_AC64A0BACCFA12B8');
        $this->addSql('DROP INDEX UNIQ_AC64A0BACEF25CA7');
        $this->addSql('DROP INDEX UNIQ_AC64A0BACCFA12B8');
        $this->addSql('ALTER TABLE api_user DROP trades_person_id');
        $this->addSql('ALTER TABLE api_user DROP profile_id');
        $this->addSql('ALTER TABLE api_user ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE profile ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE profile ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE payment_method ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE payment_method ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE authentication_token ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE authentication_token ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE payment ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE payment ALTER booking_id TYPE UUID');
        $this->addSql('ALTER TABLE notification ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE notification ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE availability ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE availability ALTER tradesperson_id TYPE UUID');
        $this->addSql('ALTER TABLE notification_settings ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE notification_settings ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE calendar ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE calendar ALTER tradesperson_id TYPE UUID');
    }
}
